import fs from 'node:fs';
import assert from 'node:assert/strict';
import { chromium } from 'playwright';

const base = process.env.CMS_BROWSER_BASE || 'http://127.0.0.1:8100';
const out = 'tests/browser/results';
fs.mkdirSync(out, { recursive: true });
const routes = JSON.parse(fs.readFileSync('tests/browser/admin-routes.json', 'utf8'));

function pathFor(key, ending) {
  const route = routes.find((r) => r.name?.includes(key) && r.name.endsWith(ending));
  assert.ok(route, 'Missing Filament route for '+key+' / '+ending);
  return '/' + route.uri.replace(/^\/+/, '');
}

const textCreate = pathFor('site-copy-overrides', '.create');
const photoCreate = pathFor('site-media-items', '.create');
assert.ok(process.env.CMS_CHROME_BIN, 'Preinstalled Chrome executable is required');
const browser = await chromium.launch({
  headless: true,
  executablePath: process.env.CMS_CHROME_BIN,
  args: ['--no-sandbox'],
});
let failed = false;

try {
  for (const width of [1440, 390]) {
    const context = await browser.newContext({
      viewport: { width, height: width === 390 ? 844 : 900 },
      deviceScaleFactor: 1,
      isMobile: width === 390,
      hasTouch: width === 390,
    });
    const page = await context.newPage();
    const pageErrors = [];
    page.on('pageerror', (e) => pageErrors.push(String(e.message)));

    try {
      const login = await page.goto(base + '/admin/login', {
        waitUntil: 'domcontentloaded', timeout: 30000,
      });
      assert.equal(login?.status(), 200, 'Admin login HTTP status');

      const email = page.locator('input[type=email]').first();
      const password = page.locator('input[type=password]').first();
      await email.waitFor({ state: 'visible', timeout: 10000 });
      await email.fill('cms-admin@test.invalid');
      await password.fill('random-ci-only-password-2026');
      await page.locator('button[type=submit]').first().click();
      await page.waitForURL((url) => !url.pathname.endsWith('/admin/login'), {
        timeout: 15000,
      });
      assert.ok(!page.url().includes('/login'), 'Admin must be authenticated');

      const cases = [
        { title: 'page-text-editor', path: textCreate, expected: 'Text block' },
        { title: 'media-upload-editor', path: photoCreate, expected: 'Photos and videos' },
      ];
      for (const item of cases) {
        const res = await page.goto(base + item.path, {
          waitUntil: 'domcontentloaded', timeout: 30000,
        });
        assert.equal(res?.status(), 200, item.title+' HTTP status');
        const text = await page.locator('body').innerText();
        assert.ok(text.includes(item.expected), item.title+' expected label not found');
        if (item.title === 'media-upload-editor') {
          assert.ok(text.includes('Раздел сайта'), 'Media collection selector missing');
          assert.ok(text.includes('Позиция на странице'), 'Media placement selector missing');
        }
        await page.screenshot({
          path: out+'/'+item.title+'-'+width+'.png',
          fullPage: true,
        });
        const size = await page.evaluate(() => ({
          inner: window.innerWidth,
          scroll: document.documentElement.scrollWidth,
        }));
        assert.ok(size.scroll <= size.inner + 8, item.title+' horizontal viewport overflow: '+JSON.stringify(size));
        console.log('BROWSER_PASS '+item.title+' '+width+'px '+item.path);
      }
      assert.deepEqual(pageErrors, [], 'JavaScript page exceptions');
    } catch (error) {
      failed = true;
      await page.screenshot({
        path: out+'/failure-'+width+'.png',
        fullPage: true,
      }).catch(() => {});
      console.error('BROWSER_FAIL '+width+'px '+String(error.stack || error));
    } finally {
      await context.close();
    }
  }
} finally {
  await browser.close();
}

if (failed) process.exit(1);
console.log('CMS_BROWSER_SMOKE_PASS desktop and mobile authenticated editors');

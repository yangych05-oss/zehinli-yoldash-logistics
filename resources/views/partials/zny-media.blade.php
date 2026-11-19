@php
$znyLocale = in_array(app()->getLocale(), ['ru','tm','en'], true) ? app()->getLocale() : 'en';
$znyLabels = [
 'ru'=>[
  'fieldEyebrow'=>'ZNY LOGISTICS · ФОТОРЕПОРТАЖ', 'fieldTitle'=>'Логистика в работе',
  'fieldDesc'=>'Фотографии грузовой инфраструктуры, перевозок и операционной деятельности.',
  'eventEyebrow'=>'МЕЖДУНАРОДНАЯ ДЕЯТЕЛЬНОСТЬ', 'eventTitle'=>'Порты, выставки и деловые встречи',
  'eventDesc'=>'Видео и фотографии международных событий и посещения порта Гамбурга.',
  'morePhotos'=>'Другие фотографии', 'moreVideos'=>'Другие видео',
  'photos'=>['Продуктовая логистика','Негабаритные грузы','Промышленные грузы','Специальные грузовые операции','Контейнерные операции','Выставка Logitrans','Порт Гамбурга','Международные партнёрства','Портовая инфраструктура'],
  'videos'=>['Порт Гамбурга — видеорепортаж','Международный выставочный центр','Деловые встречи','Выставочный павильон','Международная выставка 2026','Встреча партнёров','Мероприятие Logitrans']
 ],
 'tm'=>[
  'fieldEyebrow'=>'ZNY LOGISTICS · FOTOSURATLAR','fieldTitle'=>'Logistika iş ýüzünde',
  'fieldDesc'=>'Ýük infrastrukturasynyň, daşamalaryň we amaly işleriň hakyky pursatlary.',
  'eventEyebrow'=>'HALKARA IŞJEŇLIK','eventTitle'=>'Portlar, sergiler we işewür duşuşyklar',
  'eventDesc'=>'Halkara çärelerden we Gamburg portuna sapardan wideo hem-de fotosuratlar.',
  'morePhotos'=>'Beýleki suratlar','moreVideos'=>'Beýleki wideolar',
  'photos'=>['Azyk önümleriniň logistikasy','Uly göwrümli ýükler','Senagat ýükleri','Ýörite ýük işleri','Konteýner işleri','Logitrans sergisi','Gamburg porty','Halkara hyzmatdaşlyk','Port infrastrukturasy'],
  'videos'=>['Gamburg porty — wideo','Halkara sergi merkezi','Işewür duşuşyklar','Sergi pawilýony','Halkara sergi 2026','Hyzmatdaşlaryň duşuşygy','Logitrans çäresi']
 ],
 'en'=>[
  'fieldEyebrow'=>'ZNY LOGISTICS · FIELD REPORT','fieldTitle'=>'Logistics in action',
  'fieldDesc'=>'Authentic moments from freight infrastructure, cargo handling and operations.',
  'eventEyebrow'=>'INTERNATIONAL ENGAGEMENT','eventTitle'=>'Ports, exhibitions and business meetings',
  'eventDesc'=>'Video and photo highlights of international events and a visit to the Port of Hamburg.',
  'morePhotos'=>'More photographs','moreVideos'=>'More videos',
  'photos'=>['Produce logistics','Oversized cargo','Industrial freight','Special cargo operations','Container handling','Logitrans exhibition','Port of Hamburg','International partnerships','Port infrastructure'],
  'videos'=>['Port of Hamburg — video report','International exhibition hall','Business meetings','Exhibition pavilion','International Expo 2026','Global partnerships','Logitrans event']
 ],
];
$znyT = $znyLabels[$znyLocale];
$znyPhotos=['produce-logistics.webp','oversize-industrial-transport.webp','industrial-steel-coils.webp','special-cargo-operations.webp','freight-drum-container.webp','logitrans-exhibition-photo.webp','hamburg-port-story.webp','international-partnerships.webp','hamburg-port-cover.webp'];
$znyVideos=[
 ['file'=>'hamburg-port-mobile.mp4','poster'=>'hamburg-port-visit-poster.webp'],
 ['file'=>'international-exhibition-hall.mp4','poster'=>'international-exhibition-hall-poster.webp'],
 ['file'=>'business-meetings.mp4','poster'=>'business-meetings-poster.webp'],
 ['file'=>'expo-pavilion.mp4','poster'=>'expo-pavilion-poster.webp'],
 ['file'=>'import-expo-2026.mp4','poster'=>'import-expo-2026-poster.webp'],
 ['file'=>'global-partnership-event.mp4','poster'=>'global-partnership-event-poster.webp'],
 ['file'=>'logitrans-event.mp4','poster'=>'logitrans-event-poster.webp'],
];
// The existing public assets remain the default until a slot is published.
$znyPhotos = array_map(static fn (string $file): string => 'media/zny/2026/'.$file, $znyPhotos);
$znyVideos = array_map(static fn (array $clip): array => [
    'file' => 'media/zny/2026/'.$clip['file'],
    'poster' => 'media/zny/2026/'.$clip['poster'],
], $znyVideos);
foreach (\App\Support\CmsContent::media('image', $znyLocale) as $slot => $item) {
    $znyPhotos[$slot] = $item['file_path'];
    $znyT['photos'][$slot] = $item['caption'] ?: ($znyT['photos'][$slot] ?? 'ZNY LOGISTICS');
}
foreach (\App\Support\CmsContent::media('video', $znyLocale) as $slot => $item) {
    $znyVideos[$slot] = [
        'file' => $item['file_path'],
        'poster' => $item['poster_path'] ?? ($znyVideos[$slot]['poster'] ?? null),
    ];
    $znyT['videos'][$slot] = $item['caption'] ?: ($znyT['videos'][$slot] ?? 'ZNY LOGISTICS video');
}
ksort($znyPhotos);
ksort($znyVideos);
@endphp
@once
<link rel="stylesheet" href="{{ asset('media/zny/2026/gallery.css') }}?v=20261119">
@endonce
<section class="zny-media" aria-labelledby="zny-field-title">
  <div class="zny-media-heading">
    <span class="zny-media-eyebrow">{{ $znyT['fieldEyebrow'] }}</span>
    <h2 id="zny-field-title">{{ $znyT['fieldTitle'] }}</h2>
    <p>{{ $znyT['fieldDesc'] }}</p>
  </div>
  <div class="zny-media-photo-grid" tabindex="0" role="region" aria-label="{{ $znyT['fieldTitle'] }}">
    @foreach(array_slice($znyPhotos, 0, 4, true) as $i => $photo)
      <figure class="zny-media-photo-card {{ $i >= 6 ? 'is-wide' : '' }}">
        <img src="{{ asset($photo) }}" alt="{{ $znyT['photos'][$i] }}" loading="lazy" decoding="async" width="740" height="900">
        <figcaption>{{ $znyT['photos'][$i] }}</figcaption>
      </figure>
    @endforeach
  </div>
  <details class="zny-media-more">
    <summary>{{ $znyT['morePhotos'] }}</summary>
    <div class="zny-media-photo-grid" tabindex="0" role="region" aria-label="{{ $znyT['fieldTitle'] }}">
      @foreach(array_slice($znyPhotos, 4, 2, true) as $i => $photo)
        <figure class="zny-media-photo-card {{ $i >= 6 ? 'is-wide' : '' }}">
          <img src="{{ asset($photo) }}" alt="{{ $znyT['photos'][$i] }}" loading="lazy" decoding="async" width="740" height="900">
          <figcaption>{{ $znyT['photos'][$i] }}</figcaption>
        </figure>
      @endforeach
    </div>
  </details>
</section>
<section class="zny-media zny-media-events" aria-labelledby="zny-events-title">
  <div class="zny-media-heading">
    <span class="zny-media-eyebrow">{{ $znyT['eventEyebrow'] }}</span>
    <h2 id="zny-events-title">{{ $znyT['eventTitle'] }}</h2>
    <p>{{ $znyT['eventDesc'] }}</p>
  </div>
  <div class="zny-media-photo-grid zny-media-landscape-grid" tabindex="0" role="region" aria-label="{{ $znyT['eventTitle'] }}">
    @foreach(array_slice($znyPhotos, 6, null, true) as $i => $photo)
      <figure class="zny-media-photo-card is-wide">
        <img src="{{ asset($photo) }}" alt="{{ $znyT['photos'][$i] }}" loading="lazy" decoding="async" width="1600" height="900">
        <figcaption>{{ $znyT['photos'][$i] }}</figcaption>
      </figure>
    @endforeach
  </div>
  <div class="zny-media-video-grid" tabindex="0" role="region" aria-label="{{ $znyT['eventTitle'] }}">
    @foreach(array_slice($znyVideos, 0, 3, true) as $i => $clip)
      <figure class="zny-media-video-card">
        <video controls playsinline preload="none" poster="{{ $clip['poster'] ? asset($clip['poster']) : '' }}" width="360" height="640" aria-label="{{ $znyT['videos'][$i] }}">
          <source src="{{ asset($clip['file']) }}" type="{{ str_ends_with($clip['file'], '.webm') ? 'video/webm' : 'video/mp4' }}">
        </video>
        <figcaption>{{ $znyT['videos'][$i] }}</figcaption>
      </figure>
    @endforeach
  </div>
  <details class="zny-media-more">
    <summary>{{ $znyT['moreVideos'] }}</summary>
    <div class="zny-media-video-grid" tabindex="0" role="region" aria-label="{{ $znyT['eventTitle'] }}">
      @foreach(array_slice($znyVideos, 3, null, true) as $i => $clip)
        <figure class="zny-media-video-card">
          <video controls playsinline preload="none" poster="{{ $clip['poster'] ? asset($clip['poster']) : '' }}" width="360" height="640" aria-label="{{ $znyT['videos'][$i] }}">
            <source src="{{ asset($clip['file']) }}" type="{{ str_ends_with($clip['file'], '.webm') ? 'video/webm' : 'video/mp4' }}">
          </video>
          <figcaption>{{ $znyT['videos'][$i] }}</figcaption>
        </figure>
      @endforeach
    </div>
  </details>
</section>

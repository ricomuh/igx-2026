@props(['data'])

@push('style')
<style>
  .group:hover > .group\/item:not(:hover) {
    filter: blur(3px);
    opacity: 0.6;
    transition: filter 0.3s ease, opacity 0.3s ease;
  }
</style>
@endpush


<div class="relative overflow-hidden rounded-xl w-full aspect-4/5 transition-transform duration-200 hover:scale-105 group/item">
  <img
    src="{{ $data->image_url }}"
    alt="{{ $data->name }}"
    loading="lazy"
    class="object-cover w-full h-full transition-transform duration-300"
  />

  @if ($data->url)
    <a
      href="{{ $data->url }}"
      target="_blank"
      rel="noopener noreferrer"
      class="absolute inset-0 z-10"
    >
      <span class="sr-only">Visit {{ $data->name }} Instagram</span>
    </a>
  @endif
</div>

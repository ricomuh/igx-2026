@props([
  'route' => request()->url(),
  'name' => 'sort_by',
  'options' => [
    'latest' => 'Newest First',
    'oldest' => 'Oldest First',
    'name_asc' => 'Name (A-Z)',
    'name_desc' => 'Name (Z-A)',
  ],
  'selected' => request('sort_by'),
  'additional' => ['search' => request('search')]
])

<form method="GET" action="{{ $route }}">
  @foreach ($additional ?? [] as $key => $val)
    <input type="hidden" name="{{ $key }}" value="{{ $val }}">
  @endforeach

  <select name="{{ $name ?? 'sort_by' }}"
      class="btn-primary py-2 px-4 font-bold rounded-lg h-[40px] text-base leading-6 w-full sm:w-auto"
      onchange="this.form.submit()">
    @foreach ($options as $value => $label)
      <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}</option>
    @endforeach
  </select>
</form>

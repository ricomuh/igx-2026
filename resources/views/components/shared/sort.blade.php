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
      class="bg-highlight border-3 border-black shadow-brutal-sm py-2 px-4 font-extrabold uppercase text-sm text-black h-[42px] w-full sm:w-auto cursor-pointer appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2020%2020%22%20fill%3D%22black%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20d%3D%22M5.23%207.21a.75.75%200%20011.06.02L10%2011.168l3.71-3.938a.75.75%200%20111.08%201.04l-4.25%204.5a.75.75%200%2001-1.08%200l-4.25-4.5a.75.75%200%2001.02-1.06z%22%20clip-rule%3D%22evenodd%22%2F%3E%3C%2Fsvg%3E')] bg-[length:14px] bg-[right_8px_center] bg-no-repeat pr-8"
      onchange="this.form.submit()">
    @foreach ($options as $value => $label)
      <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}</option>
    @endforeach
  </select>
</form>

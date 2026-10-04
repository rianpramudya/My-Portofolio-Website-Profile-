<form action="{{ route('admin.cv.download') }}" method="GET" class="bg-white p-3 rounded-lg shadow-lg">
    <input type="hidden" name="type" value="{{ $cvType }}">
    @include('admin.cv.partials.language_select')
    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-indigo-700 text-sm">Download PDF</button>
    <p class="text-xs text-slate-500 mt-2">Bahasa preview: {{ ['original' => 'Asli', 'id' => 'Indonesia', 'en' => 'English'][$cvLanguage] }}.</p>
</form>

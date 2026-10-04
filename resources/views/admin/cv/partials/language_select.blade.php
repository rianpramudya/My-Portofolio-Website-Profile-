<label class="block text-sm font-semibold text-slate-700 text-left">
    Bahasa CV
    <select name="language" class="block w-full min-h-11 mt-2 rounded-lg border border-slate-300 bg-white text-slate-800 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-indigo-500" required>
        <option value="original" @selected(($cvLanguage ?? 'original') === 'original')>Bahasa asli input</option>
        <option value="id" @selected(($cvLanguage ?? '') === 'id')>Bahasa Indonesia</option>
        <option value="en" @selected(($cvLanguage ?? '') === 'en')>English</option>
    </select>
</label>

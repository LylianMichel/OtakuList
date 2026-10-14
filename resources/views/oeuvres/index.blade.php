<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Index oeuvre</title>
</head>
<body>
    <h1>index anime liste</h1>
    <form method="GET" action="{{ route('oeuvres.index') }}" class="mb-6 flex flex-wrap items-end gap-3">
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700">

                Rechercher une œuvre
            </label>

            <input
                type="text"
                id="search"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Titre de l'œuvre"
                class="mt-1 rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
        </div>

        <button
            type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-medium text-white hover:bg-indigo-500"
        >
            Rechercher
        </button>
    </form>

    <x-oeuvre-grid :oeuvres="$oeuvres" />

</body>

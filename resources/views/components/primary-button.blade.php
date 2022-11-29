<button {{ $attributes->merge(['class' => 'inline-flex items-center justify-center gap-2.5 px-4 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-green-800 active:bg-green-800 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 ']) }}>
    {{ $slot }}
</button>

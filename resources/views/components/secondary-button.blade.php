<button {{ $attributes->merge(['class' => 'inline-flex items-center justify-center gap-2 p-2 min-w-[50px] bg-gray-700 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ']) }}>
    {{ $slot }}
</button>

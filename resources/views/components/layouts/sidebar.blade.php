<!-- sidebar -->
<div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
    <a href="#" class="flex items-center pb-4 border-b border-b-gray-800 ">
        <h2 class="font-bold text-2xl">Inven <span class="bg-[#f84525] text-white px-2 rounded-md">tory</span></h2>
    </a>
    <ul class="mt-4">
        <li @class([ 'mb-1' , 'group' , 'active'=> Request::is('/') ])>
            <a href="/" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">Dashboard</span>
            </a>
        </li>
        <li @class([ 'mb-1' , 'group' , 'active'=> Request::is('customers*') ])>
            <a href="{{ route('customers.index') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">{{ __("Customers") }}</span>
            </a>
        </li>
        <li @class([ 'mb-1' , 'group' , 'active'=> Request::is('brands*') ])>
            <a href="{{ route('brands.index') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">{{ __("Brands") }}</span>
            </a>
        </li>
        <li @class([ 'mb-1' , 'group' , 'active'=> Request::is('categories*') ])>
            <a href="{{ route('categories.index') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">{{ __("Categories") }}</span>
            </a>
        </li>
        <li @class([ 'mb-1' , 'group' , 'active'=> Request::is('warehouses*') ])>
            <a href="{{ route('warehouses.index') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">{{ __("Warehouses") }}</span>
            </a>
        </li>
        <li @class([ 'mb-1' , 'group' , 'active'=> Request::is('products*') ])>
            <a href="{{ route('products.index') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">{{ __("Products") }}</span>
            </a>
        </li>
        <li @class([ 'mb-1' , 'group' , 'active'=> Request::is('movements*') ])>
            <a href="{{ route('movements.index') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">{{ __("Movements") }}</span>
            </a>
        </li>
        <li @class([ 'mb-1' , 'group' , 'active'=> Request::is('transfers*') ])>
            <a href="{{ route('transfers.index') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">{{ __("Transfers") }}</span>
            </a>
        </li>
    </ul>
</div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
<!-- end sidebar -->
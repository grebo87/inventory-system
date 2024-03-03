<div>
    <section class="grid w-full overflow-x-scroll rounded-lg lg:overflow-visible mb-4">
        <div class="flex flex-col text-left">
            <h4 class="block font-sans text-2xl font-semibold leading-snug tracking-normal text-inherit antialiased">
                {{ __("Customers") }}
            </h4>
        </div>
    </section>
    <!-- ################3333333 -->

    <div class="grid grid-cols-1 lg:grid-cols-1 gap-12 mb-12">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
            <!-- #############################################3333 -->
            <section class=" p-3 sm:p-5">




                <!-- <header class="fi-header flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                    </div>
                    <div class="fi-ac gap-3 flex flex-wrap items-center justify-start shrink-0 sm:mt-7" bis_skin_checked="1">

                        <a href="{{ route('customers.create') }}" type="button" class="flex items-center justify-centerfocus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Agregar cliente
                        </a>
                    </div>
                </header> -->
                <div class="overflow-x-auto">
                    {{ $this->table }}
                </div>
            </section>
            <!-- #######################################333 -->
        </div>
    </div>
</div>
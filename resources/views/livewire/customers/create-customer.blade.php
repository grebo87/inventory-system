<div>
    <section class="grid w-full overflow-x-scroll rounded-lg lg:overflow-visible mb-4">
        <div class="flex flex-col text-left">
            <h4 class="block font-sans text-2xl font-semibold leading-snug tracking-normal text-inherit antialiased">
                {{__("Create Customer")}}
            </h4>
        </div>
    </section>
    <!-- ################3333333 -->

    <div class="grid grid-cols-1 lg:grid-cols-1 gap-12 mb-12">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
            <!-- #############################################3333 -->
            <section class="border mt-4 p-4 sm:p-5 overflow-hidden rounded-xl dark:bg-gray-800">
                <form wire:submit="create">


                {{ $this->form }}


                    
                    <div class="mt-6 gap-x-6">
                        <a href="{{ route('customers.index') }}" type="button" class="px-6 py-2 text-sm font-semibold select-none rounded-md text-gray-800 bg-gray-200 hover:bg-gray-300">
                            {{__("Cancel")}}
                        </a>
                        <button type="submit" class="rounded-md bg-indigo-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            {{__("Save")}}
                        </button>
                    </div>


                </form>
            </section>
            <!-- #######################################333 -->
        </div>
    </div>
</div>
<div>
    <section class="grid w-full overflow-x-scroll rounded-lg lg:overflow-visible mb-4">
        <div class="flex flex-col text-left">
            <h4 class="block font-sans text-2xl font-semibold leading-snug tracking-normal text-inherit antialiased">
                {{ __("New Transfer") }}
            </h4>
        </div>
    </section>
    <!-- ################3333333 -->

    <div class="grid grid-cols-1 lg:grid-cols-1 gap-2 mb-12">
        <div class=" bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
            <!-- #############################################3333 -->
            <x-filament::section class="mt-5 grid grid-cols-2 fi-fo-component-ctn gap-6">

               

                        <div data-field-wrapper="" class="fi-fo-field-wrp" bis_skin_checked="1">
                            <div class="grid gap-y-2" bis_skin_checked="1">
                                <div class="flex items-center justify-between gap-x-3 " bis_skin_checked="1">
                                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="data.origin_warehouse_id">
                                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                            Origin warehouse
                                            <sup class="text-danger-600 dark:text-danger-400 font-medium">*</sup>
                                        </span>
                                    </label>
                                </div>
                                <div class="grid gap-y-2" bis_skin_checked="1">
                                    <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-select" bis_skin_checked="1">
                                        <div class="min-w-0 flex-1" bis_skin_checked="1">
                                           

                                            <x-filament::input.select wire:model="status">
                                            <option value="draft">Draft</option>
                                            <option value="reviewing">Reviewing</option>
                                            <option value="published">Published</option>
                                            </x-filament::input.select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




            </x-filament::section>
            <section class="mt-5 p-3 sm:p-5 bg-white dark:bg-gray-900  rounded-xl">



                <form wire:submit="create">
                    {{ $this->form }}

                    <x-filament::button type="submit" class="mt-4">{{__("Create")}}</x-filament::button>




                    <x-filament::input.wrapper>
                        <x-filament::input type="text" wire:model="name" />
                    </x-filament::input.wrapper>
                </form>

                <x-filament-actions::modals />





            </section>


            <!-- #######################################333 -->
        </div>
    </div>
</div>
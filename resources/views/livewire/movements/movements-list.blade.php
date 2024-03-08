<div>
    <section class="grid w-full overflow-x-scroll rounded-lg lg:overflow-visible mb-4">
        <div class="flex flex-col text-left">
            <h4 class="block font-sans text-2xl font-semibold leading-snug tracking-normal text-inherit antialiased">
                {{ __("Movements") }}
            </h4>
        </div>
    </section>
    <!-- ################3333333 -->

    <div class="grid grid-cols-1 lg:grid-cols-1 gap-2 mb-12">
        <div class=" bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
            <!-- #############################################3333 -->
            <section class=" p-3 sm:p-5">
                <div class="overflow-x-auto">
                    {{ $this->table }}
                </div>
            </section>
            <!-- #######################################333 -->
        </div>
    </div>
</div>
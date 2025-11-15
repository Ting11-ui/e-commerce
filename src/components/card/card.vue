<template>
  <div class="px-8">
    <div class="flex items-center justify-between w-full h-24">
      <h1 class="text-3xl font-bold text-gray-500 cursor-pointer">
        Popular Products
      </h1>

      <div class="flex items-center gap-8 px-12 h-full font-bold text-gray-500 cursor-pointer">
        <h2>All</h2>
        <h2 class="whitespace-nowrap">Milks & Dairies</h2>
        <h2 class="whitespace-nowrap">Coffees & Teas</h2>
        <h2 class="whitespace-nowrap">Pet Foods</h2>
        <h2>Meats</h2>
        <h2>Vegetables</h2>
        <h2>Fruits</h2>
      </div>
    </div>

    <div class="grid grid-cols-6 gap-2 mt-5">
      <div class="h-95 w-full border border-green-300 rounded-md ">
        <div class="label w-15 h-9 text-center text-white pt-1 mt-3 bg-green-500 rounded-r-full">
          -17%
        </div>

        <div class="flex justify-center">
          <img src="../../assets/images/mango.png" alt="Mango" class="w-35 h-35" />
        </div>

        <div class="p-4 ">
          <ul>
            <li>Hodo Foods</li>
            <li>Seeds of Change Organic Quinoa, Brown, & Red Rice</li>
            <li>⭐⭐⭐⭐⭐ (4.0)</li>
            <li>500gram</li>
            <ul class="flex pt-2">
              <li >$2.51</li>
              <li class="ps-3">$2.00</li>

              <div class="flex justify-center items-center gap-4 ms-7 -mt-2 border border-green-300 rounded-sm w-25 h-10 px-2">
                <h1 class="text-2xl text-green-500">1</h1>
                <div class="flex flex-col ">
                  <button>
                   <i class="pi pi-chevron-up text-green-500 text-sm bg-red-300"></i>
                  </button>


                  <button>
                    <i class="pi pi-chevron-down text-green-500 text-sm bg-red-300"></i>
                  </button>

                </div>
              </div>
            </ul>
          </ul>

        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>

</script>

<style>

</style>

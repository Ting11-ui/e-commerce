<template>
  <div class="w-full h-[400px] bg-(--main-color5) mt-16 rounded-3xl relative overflow-hidden">
          <img src="../../assets/images/shadowflower.png" alt="" class="absolute inset-0 object-cover w-full h-full opacity-100">
          <div class="grid grid-cols-10 relative z-10 h-full">
            <div class="col-span-6 flex flex-col justify-center p-12 pl-40 ">
              <h1 class="text-6xl text-(--main-color2) font-bold leading-tight mb-6">
                Don't miss amazing<br>grocery deals
              </h1>
              <p class="text-gray-500 text-lg mb-6">Sign up for the daily newsletter</p>

              <div class="flex max-w-md">
                <div class="flex items-center bg-white rounded-l-full px-6 py-3 flex-1">
                  <i class="fi fi-rs-paper-plane text-gray-400 mr-3"></i>
                  <input type="email" placeholder="Your email address" class="outline-none flex-1 text-gray-600"/>
                </div>
                <button class="bg-green-500 rounded-full text-white px-8 py-3 font-semibold hover:bg-green-600 whitespace-nowrap -ml-6">
                  Subscribe
                </button>
              </div>
            </div>

            <div class="col-span-4 relative flex items-center justify-center overflow-visible ">
              <img
                src="../../assets/images/fresh-apples-shopping-mesh-bag-with-branch-apples-removebg.png"
                alt=""
                class="absolute w-[140%] h-auto object-contain right-[0%] top-1/2 transform -translate-y-1/2 "
              />
            </div>
          </div>
        </div>
</template>

<script lang="ts" setup>

</script>

<style>

</style>

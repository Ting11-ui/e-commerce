<template>
  <div>
    <div class="w-full h-90 bg-teal-50 rounded-3xl mt-12 relative overflow-hidden">
      <div class="grid grid-cols-12 h-full">

        <div class="col-span-6 flex flex-col h-full justify-center items-center">
          <!-- Category Name -->
          <h1 class="text-5xl font-bold text-gray-800 mb-4">
            {{ currentCategory?.name || 'Loading...' }}
          </h1>

          <!-- Breadcrumb -->
          <nav class="flex items-center gap-2 px-8 py-2 relative z-10">
            <!-- Home -->
            <router-link
              to="/"
              class="text-gray-400 hover:text-(--main-color1) transition-colors text-2xl"
            >
              Home
            </router-link>

            <span class="text-(--main-color3) text-xl pt-3">
              <i class="fi fi-rs-angle-small-right" aria-hidden="true"></i>
            </span>

            <router-link
              to="/"
              class="text-gray-400 hover:text-(--main-color1) transition-colors text-2xl"
            >
              Categories
            </router-link>

            <span class="text-(--main-color3) text-xl pt-3">
              <i class="fi fi-rs-angle-small-right" aria-hidden="true"></i>
            </span>

            <span class=" text-(--main-color1) hover:text-gray-500 font-medium text-2xl ">
              {{ currentCategory?.name || 'Loading...' }}
            </span>
          </nav>

          <div class="absolute bottom-0 left-0">
            <img
              src="../../assets/images/shadowCategoriesLeft.png"
              class="h-[250px] object-contain"
            >
          </div>
        </div>

        <div class="col-span-6 flex flex-col h-full">
          <div class="flex flex-1 items-center justify-center">
            <!-- Optional content -->
          </div>

          <div class="absolute bottom-0 right-0">
            <img
              src="../../assets/images/shadowCategoriesRight.png"
              class="h-[250px] object-contain"
            >
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { computed, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useProductStore } from '../../stores/product.js'

const route = useRoute()

const productStore = useProductStore()

// Get category ID from URL
const categoryId = computed(() => Number(route.params.categoryId))

// Find the matching category from your store
const currentCategory = computed(() => {
  //return productStore.categories.find(cat => cat.id === categoryId.value)
   return productStore.categories.find((cat: { id: number }) => cat.id === categoryId.value)
         || { id: categoryId.value, name: `Category ${categoryId.value}` }
})

// Load categories if not already loaded
onMounted(() => {
  if (productStore.categories.length === 0) {
    productStore.loadData()
  }
})

</script>

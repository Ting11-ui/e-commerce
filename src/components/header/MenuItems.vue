<template>
  <div class="w-full h-25 border-t border-b border-(--main-color4) ps-8 flex justify-between items-center ">

    <!-- Browse All button -->
    <div class="flex bg-(--main-color1) text-white font-semibold w-57 justify-evenly items-center h-15 rounded-md">
      <i class="fi fi-rs-apps text-sm"></i>
      <button>
        Browse All Categories
      </button>
      <i class="fa fa-chevron-down text-sm"></i>
    </div>

    <!-- Menu Items -->
    <div>
      <ul class="text-(--main-color2) text-xl font-bold flex gap-7">

        <!-- Hot Deals -->
        <li class="flex items-center gap-2 cursor-pointer hover-item hover:text-(--main-color1)"
            @click="goToCategoriesById(11)">
          <i class="fi fi-rs-flame text-(--main-color1)"></i>
          Hot Deals
        </li>

        <!-- Home -->
        <li class="cursor-pointer hover-item hover:text-(--main-color1)" @click="goToHome">
          Home
        </li>

        <!-- Dynamic Menu Items -->
        <li v-for="item in menuItems"
            :key="item.id"
            class="flex items-center gap-2 cursor-pointer hover-item hover:text-(--main-color1)"
            @click="goToCategoriesById(item.categoriesId)"
        >
          {{ item.name }}
          <i v-if="item.hasDropdown"
             class="fa fa-chevron-down text-sm text-(--main-color3)">
          </i>
        </li>
      </ul>
    </div>

    <!-- Support -->
    <div class=" flex w-57 h-15 gap-2 me-4 items-center">
      <i class="fi fi-rs-headset text-6xl pt-2 text-(--main-color2)"></i>
      <div class="text-center">
        <h1 class="text-2xl font-bold text-(--main-color1)">099 777 888</h1>
        <h1 class="font-semibold text-(--main-color3)">24/7 Support Center</h1>
      </div>
    </div>

  </div>
</template>

<script lang="ts" setup>
import { useRouter } from 'vue-router'

const router = useRouter()

//const hotDeals = { id: 11, name: 'Hot Deals' }

 const menuItems = [
  { id: 1, name: 'Food', categoriesId: 12, hasDropdown: true },
  { id: 2, name: 'Vegetables', categoriesId: 13, hasDropdown: true },
  { id: 3, name: 'Drink', categoriesId: 14, hasDropdown: false },
  { id: 4, name: 'Cookies', categoriesId: 15, hasDropdown: false },
  { id: 5, name: 'Meat & Seafood', categoriesId: 16, hasDropdown: true },
  { id: 6, name: 'Bakery', categoriesId: 17, hasDropdown: false },
]

const goToHome = () => {
  router.push('/temp').then(() => {
    router.replace('/')
  })
}

const goToCategoriesById = (categoriesId: number) => {
  router.push(`/categories/${categoriesId}`)
}
</script>

<style>
</style>

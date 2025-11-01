<template>
  <div class="p-14 ">
    <CategoryItem class="bg-[#F2FCE4] border border-[#9eba76] hover:border-[#5e8030]"
      :image="cat1"
      name="Cake & Milk"
      :qty="14"
    />

    <CategoryItem class="bg-[#FFFCEB] border border-[#fdf8d7] hover:border-[#c7bc67]"
      :image="cat2"
      name="Peach"
      :qty="17"
    />
    <CategoryItem class="bg-[#ECFFEC] border border-[#d6f6d6] hover:border-[#90db90]"
      :image="cat3"
      name="Organic Kiwi"
      :qty="21"
    />
    <CategoryItem class="bg-red-100 border border-red-200 hover:border-red-400"
      :image="cat4"
      name="Red Apple"
      :qty="68"
    />
    <CategoryItem class="bg-pink-100 border border-pink-200 hover:border-pink-400"
      :image="cat5"
      name="Snack"
      :qty="34"
    />
    <CategoryItem class="bg-[#F2FCE4] border border-[#ecfcd6] hover:border-[#788b5c]"
      :image="cat6"
      name="Black Plum"
      :qty="25"
    />
    <CategoryItem class="bg-[#FFF3EB] border border-[#fae6d8] hover:border-[#d1ad95]"
      :image="cat7"
      name="Vegetable"
      :qty="65"
    />
    <CategoryItem class="bg-[#FFFCEB] border border-[#fdf7d1] hover:border-[#787042]"
      :image="cat8"
      name="Headphone"
      :qty="54"
    />
    <CategoryItem class="bg-green-200 border border-green-300 hover:border-green-500"
      :image="cat9"
      name="Cake & Milk"
      :qty="33"
    />
    <CategoryItem class="bg-[#FFF3FF] border border-[#fbdffb] hover:border-[#996399]"
      :image="cat10"
      name="Orange"
      :qty="63"
    />
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import CategoryItem from './category.vue'
import cat1 from '../../src/assets/images/cat-1.png'
import cat2 from '../../src/assets/images/cat-2.png'
import cat3 from '../../src/assets/images/cat-3.png'
import cat4 from '../../src/assets/images/cat-4.png'
import cat5 from '../../src/assets/images/cat-5.png'
import cat6 from '../../src/assets/images/cat-6.png'
import cat7 from '../../src/assets/images/cat-7.png'
import cat8 from '../../src/assets/images/cat-8.png'
import cat9 from '../../src/assets/images/cat-9.png'
import cat10 from '../../src/assets/images/cat-10.png'

export default defineComponent({
  name: 'ItemCard',
  components: {
    CategoryItem
  },
  data() {
    return {
      cat1,
      cat2,
      cat3,
      cat4,
      cat5,
      cat6,
      cat7,
      cat8,
      cat9,
      cat10,

    }
  }
})
</script>

<style scoped>
</style>

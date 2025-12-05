<!--
<template>
  <div class="bg-red-200">
    <div class="router-link">
      <router-link to="/">Home</router-link>
      <span> > </span>
      <router-link
        v-if="currentCategory"
        :to="`/categories/${currentCategory.id}`"
        class="text-gray-600 hover:text-green-500"
      >
        {{ currentCategory.name }}
      </router-link>
      <span> > </span>

      <span class=" text-(--main-color1) hover:text-gray-500 font-medium text-2xl ">
        {{ currentProductsDetail?.name || 'Loading...' }}
      </span>
    </div>


  </div>
</template>

<script lang="ts" setup>
import { useRoute } from 'vue-router';
import { useProductStore } from '../../stores/product';
import { computed, onMounted } from 'vue';

const route = useRoute();
const productStore = useProductStore();

//const categoriesId = computed(() => Number(route.params.categoriesId));

const currentCategory = computed(() => {
  if (!currentProductsDetail.value) return null
  return productStore.categories.find((categories: {id :number}) =>categories.id === currentProductsDetail.value.categoryId)
})

const productsId= computed(() => Number(route.params.productsId));

const currentProductsDetail = computed(() => {
  return productStore.products.find((product: { id: number }) => product.id === productsId.value)
})

onMounted(() => {
  if (productStore.products.length === 0 || productStore.categories.length === 0) {
    productStore.loadData()
  }
})
</script>

<style>

</style> -->

<!-- <template>
  <div class="bg-red-200">
    <div class="router-link">
      <router-link to="/">Homew</router-link>
      <span> > </span>
      <router-link
        v-if="currentCategory"
        :to="`/categories/${currentCategory.id}`"
        class="text-gray-600 hover:text-green-500"
      >
        {{ currentCategory.name }}
      </router-link>
      <span> > </span>

      <span class=" text-(--main-color1) hover:text-gray-500 font-medium text-2xl ">
        {{ currentProductsDetail?.name || 'Loading...' }}
      </span>
    </div>


  </div>
</template>

<script lang="ts" setup>
import { useRoute } from 'vue-router';
import { useProductStore } from '../../stores/product';
import { computed, onMounted } from 'vue';

const route = useRoute();
const productStore = useProductStore();

//const categoriesId = computed(() => Number(route.params.categoriesId));

const currentCategory = computed(() => {
  if (!currentProductsDetail.value) return null
  return productStore.categories.find((categories: {id :number}) =>categories.id === currentProductsDetail.value.categoryId)
})

const productsId= computed(() => Number(route.params.productsId));

const currentProductsDetail = computed(() => {
  return productStore.products.find((product: { id: number }) => product.id === productsId.value)
})

onMounted(() => {
  if (productStore.products.length === 0 || productStore.categories.length === 0) {
    productStore.loadData()
  }
})
</script>

<style>

</style> -->

<template>
  <div>

  </div>
</template>

<script lang="ts" setup>

</script>

<style>

</style>

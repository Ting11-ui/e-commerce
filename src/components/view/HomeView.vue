<template>
  <div class="slideInTop">
    <showCaseComponent/>
    <group/>
    <PromotionsPage class="bg-red-200"/>

    <div class="home-container flex flex-col justify-start items-center pt-14">
      <!-- Categories Section -->
      <section class="categories flex flex-wrap justify-center items-center gap-5 lg:gap-10">
        <CategoryComponent
          v-for="(category, index) in productStore.categories"
          :key="index"
          :category-id="category.id"
          :name="category.name || 'Unknown Category'"
          :product-count="category.productCount || 0"
          :color="category.color || '#ccc'"
          :image="getImageUrl(category.image)"
          :alt="category.name || 'Category Image'"
          @click="goToCategory(category.id)"
          class="cursor-pointer"
        />
      </section>

      <!-- Promotions Section -->
      <section class="promotions flex flex-wrap justify-center items-center gap-5 mt-10">
        <PromotionComponent
          v-for="(promo, index) in productStore.promotions"
          :key="index"
          :title="promo.title || 'Promotion'"
          :color="promo.color || '#eee'"
          :image="getImageUrl(promo.image)"
          :button-color="promo.buttonColor || '#000'"
          :url="promo.url || '#'"
          :alt="promo.title || 'Promotion Image'"
          @click="goToPromotionsDetail(promo.id)"
        />
      </section>
    </div>

    <!-- Popular Products Section -->
    <section class="pt-10 py-20">
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
      </div>

      <div class="px-8">
        <div class="grid grid-cols-5 gap-12 mt-5">
          <ProductCard
            v-for="(card, index) in productStore.products"
            :key="index"
            :name="card.name"
            :rating="card.rating"
            :size="Number(card.size)"
            :image="getImageUrl(card.image)"
            :price="card.price"
            :promotionAsPercentage="card.promotionAsPercentage"
            @click="goToProductsDetail(card.id)"
          />
        </div>
      </div>
    </section>
  </div>
</template>

<script lang="ts" setup>
import { onMounted } from 'vue'
import { useProductStore } from '../../stores/product'
import CategoryComponent from "../category/categoryComponet.vue"
import PromotionComponent from "../promotion/promotionComponent.vue"
import group from '../group/group.vue'
import ProductCard from '../card/productsCard.vue'
import showCaseComponent from '../showCase/showCaseComponent.vue'
import { useRouter } from 'vue-router'
import PromotionsPage from '../promotion/promotionsPage.vue'

const router = useRouter()

const productStore = useProductStore()

onMounted(() => {
  productStore.loadData()
})

const getImageUrl = (imgPath: string) => {
  if (!imgPath) return 'https://via.placeholder.com/150'

  try {
    let imagePath = imgPath

    if (typeof imgPath === 'string' && (imgPath.startsWith('[') || imgPath.startsWith('\"'))) {
      const imageArray = JSON.parse(imgPath)
      imagePath = imageArray[0]
    }

    return `http://localhost:3000/${imagePath.replace(/\\/g, '/')}`
  } catch (error) {
    console.error('Error parsing image path:', error)
    return `http://localhost:3000/${imgPath.replace(/\\/g, '/')}`
  }
}

const goToCategory = (categoryId: number) => {
  router.push(`/categories/${categoryId}`)
}

const goToPromotionsDetail = (promotionsId: number) => {
  router.push(`/promotions/${promotionsId}`)
}

const goToProductsDetail = (productsId: number) => {
  router.push(`/products/${productsId}`)
}


</script>

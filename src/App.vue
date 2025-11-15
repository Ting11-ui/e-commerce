<template>
  <div>
    <Header/>

    <div class="home-container min-h-screen py-5 flex flex-col justify-start items-center pt-14">
      <!-- Categories Section -->
      <section class="categories flex flex-wrap justify-center items-center gap-5 lg:gap-10">
        <CategoryComponent
          v-for="(category, index) in categories"
          :key="index"
          :name="category.name || 'Unknown Category'"
          :product-count="category.productCount"
          :color="category.color"
          :image="`http://localhost:3000/${category.image.replace(/\\/g, '/')}`"
          :alt="category.name || 'Category Image'"
        />
      </section>

      <!-- Promotions Section -->
      <section class="promotions flex flex-wrap justify-center items-center gap-5 mt-10">
        <PromotionComponent
          v-for="(promo, index) in promotions"
          :key="index"
          :title="promo.title || 'Promotion'"
          :color="promo.color"
          :image="`http://localhost:3000/${promo.image.replace(/\\/g, '/')}`"
          :button-color="promo.buttonColor"
          :url="promo.url"
          :alt="promo.title || 'Promotion Image'"
        />
      </section>
      <Header class="mt-7"/>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import CategoryComponent from "./components/category/categoryComponet.vue";
import PromotionComponent from "./components/promotion/promotionComponent.vue";
import Header from './components/header/header.vue';

export default {
  name: "HomePage",
  components: {
    CategoryComponent,
    PromotionComponent,
    Header,
  },

  data() {
    return {
      categories: [],
      promotions: [],
    };
  },

  methods: {
    async fetchCategories() {
      try {
        const res = await axios.get("http://localhost:3000/api/categories");
        // Ensure image paths are relative to 'uploads'
        this.categories = res.data.map((c) => ({
          ...c,
          image: c.image, // keep as relative path (e.g., 'category/cat.png')
          name: c.name || "Unknown Category", // fallback if null
        }));
      } catch (err) {
        console.error("Error loading categories:", err);
      }
    },

    async fetchPromotions() {
      try {
        const res = await axios.get("http://localhost:3000/api/promotions");
        this.promotions = res.data.map((p) => ({
          ...p,
          image: p.image, // keep relative path
          title: p.title || "Promotion",
        }));
      } catch (err) {
        console.error("Error loading promotions:", err);
      }
    },
  },

  mounted() {
    this.fetchCategories();
    this.fetchPromotions();
  },
};
</script>

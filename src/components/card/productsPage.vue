<template>
  <div class="fadeIn">
    <div class="router-link p-8 ">
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

    <div class="w-full h-screen flex py-6 p-8 gap-8">
      <div class="w-1/2 h-full border-2 border-(--main-color1) rounded-xl relative">
        <div class="p-4 flex justify-center items-center h-screen">
          <img :src="productImage" alt="Product Image" class="w-full  object-cover rounded-lg">

          <!-- Search icon overlay -->
          <div class="absolute top-8 right-8 w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg cursor-pointer hover:bg-gray-100 transition">
            <i class="fa fa-search text-(--main-color3)" aria-hidden="true"></i>
          </div>
        </div>
      </div>

      <div class="w-1/2 h-full ">
        <div class="w-20 text-center">
          <h1 class="text-(--main-color1)  bg-green-200 rounded-sm font-semibold text-sm">In Stock</h1>
        </div>

        <div class="py-4 space-y-6">
          <h1 class="text-(--main-color2) text-5xl font-bold">{{currentProductsDetail?.name || 'Loading...' }}</h1>

         <span class="flex gap-2">
            <template v-for="star in 5" :key="star">
              <i v-if="currentProductsDetail?.rating >= star" class="pi pi-star-fill text-yellow-400 text-md"></i>
              <i v-else-if="currentProductsDetail?.rating >= star - 0.5" class="pi pi-star-half-fill text-yellow-400 text-md"></i>
              <i v-else class="pi pi-star text-gray-300 text-lg"></i>
            </template>
            <div class="ps-3 -mt-1 text-md text-gray-400 font-semibold">
              ({{ currentProductsDetail?.rating.toFixed(1) }})
            </div>
          </span>

          <div class="py-6 flex items-end gap-12">
            <h1 class="text-(--main-color1) font-bold text-6xl">${{ currentProductsDetail?.price.toFixed(2) }}</h1>
            <h1 class="text-gray-500 text-3xl font-bold ps-3 line-through mt-2">$2.00</h1>
          </div>

          <p class="text-(--main-color3)">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!</p>

          <div class="flex items-center gap-5 w-full h-full justify-center">
            <!-- Show Add button if not in cart, otherwise show quantity -->
          </div>
          <div class="flex gap-6 items-end">
           <div class="flex  items-center  w-35 h-13 justify-center border-[1.5px] border-(--main-color1) rounded-xl ">
            <h1 class="text-2xl text-(--main-color1)  w-8">{{ currentQuantity }}</h1>
            <div class="flex flex-col -space-y-1.5 ">
              <button @click="handleIncrement">
                <i class="upIcons pi pi-chevron-up text-green-500 hover:text-green-300 text-sm"></i>
              </button>

              <button @click="handleDecrement">
                <i class="downIcons pi pi-chevron-down text-green-500 hover:text-green-300 text-sm"></i>
              </button>
            </div>
          </div>
          <div class="flex items-center gap-4 px-3 cursor-pointer transition-colors w-45 h-13 justify-center bg-(--main-color1) hover:bg-green-400 rounded-xl">
            <i class="fa fa-shopping-cart text-white " @click="handleAddToCart" aria-hidden="true"></i>
            <span class="text-white font-semibold text-sm">Add to cart</span>
          </div>
            <div class="w-15 h-13 border-[1.5px] border-(--main-color3) rounded-xl flex justify-center">
              <i class="fi fi-rs-heart text-(--main-color3) text-xl my-auto pt-1" aria-hidden="true"></i>
            </div>

            <div class="w-15 h-13 border-[1.5px] border-(--main-color3) rounded-xl flex justify-center">
              <i class="fi fi-rs-shuffle text-(--main-color3) text-xl my-auto pt-1" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="pt-[22.5%]">
          <h1>Vendor: <span  class="text-(--main-color3)">&emsp;NestMark</span></h1>
          <h1>SKU: <span  class="text-(--main-color3)">&emsp;FWM15VKT</span></h1>
        </div>
      </div>
    </div>

<div class="p-6 space-y-8">
      <!-- Product Navigation Carousel - Slide one by one with animation -->
      <div class="w-1/2 h-35 flex items-center justify-between gap-2 ">
        <div
          class="w-13 h-13 bg-(--main-color3) hover:bg-(--main-color1) rounded-full flex items-center justify-center cursor-pointer shrink-0"
          :class="{ 'opacity-100 cursor-not-allowed': carouselIndex === 0 }"
          @click="previousProduct"
        >
          <i class="fa fa-arrow-left text-2xl text-(--main-color7) hover:text-white" aria-hidden="true"></i>
        </div>
        <div class="flex-1 overflow-hidden">
          <div
            class="flex gap-1 transition-transform duration-600 ease-in-out shadow"
            :style="{ transform: `translateX(-${carouselIndex * (100 / 4 + 1)}%)` }"
          >
            <img
              v-for="(product, index) in allProducts"
              :key="product.id"
              :src="getProductImage(product)"
              @click="navigateToProduct(product.id)"
              alt="product image"
              class="ms-2 w-10 h-38 border-2 p-3 rounded-xl cursor-pointer shrink-0 border-(--main-color1)"
              :style="{ minWidth: 'calc(25% - 0.75rem)' }"
            />
          </div>
        </div>

        <div
          class="w-13 h-13 bg-(--main-color3) hover:bg-(--main-color1) rounded-full flex items-center justify-center cursor-pointer shrink-0"
          :class="{ 'opacity-100 cursor-not-allowed': carouselIndex >= allProducts.length - 4 }"
          @click="nextProduct"
        >
          <i class="fa fa-arrow-right text-(--main-color7) hover:text-white text-2xl" aria-hidden="true"></i>
        </div>
      </div>

      <div class="h-70 border border-(--main-color8) rounded-xl">
        <div class="w-[30%] ms-12 h-30 text-center flex justify-between pt-8">
          <button class="text-xl font-semibold hover:text-(--main-color1) text-(--main-color3) text-shadow shadow bg-white rounded-full w-35 h-12 border border-(--main-color8) hover:border-(--main-color1)">
            Description
          </button>
          <button class="text-xl font-semibold hover:text-(--main-color1) text-(--main-color3) text-shadow shadow bg-white rounded-full w-40 h-12 border border-(--main-color8) hover:border-(--main-color1)">
            Additional info
          </button>
          <button class="text-xl font-semibold hover:text-(--main-color1) text-(--main-color3) text-shadow shadow bg-white rounded-full w-35 h-12 border border-(--main-color8) hover:border-(--main-color1)">
            Reviews (3)
          </button>
        </div>

        <p class="text-md text-(--main-color3) p-8 -mt-8">Uninhibited carnally hired played in whimpered dear gorilla koala depending and much yikes off far quetzal goodness and from for grimaced goodness unaccountably and meadowlark near unblushingly crucial scallop tightly neurotic hungrily some and dear furiously this apart. <br> <br>
            Spluttered narrowly yikes left moth in yikes bowed this that grizzly much hello on spoon-fed that alas rethought much decently richly and wow against the frequent fluidly at formidable acceptably flapped besides and much circa far over the bucolically hey precarious goldfinch mastodon goodness gnashed a jellyfish and one however because.
        </p>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { useRoute, useRouter } from 'vue-router';
import { useProductStore } from '../../stores/product.js';
import { computed, onMounted, ref } from 'vue';

const route = useRoute();
const router = useRouter();
const productStore = useProductStore();

const productsId = computed(() => {
  return Number(route.params.productsId || route.params.promotionsId);
});

const currentProductsDetail = computed(() => {
  return productStore.products.find((product: { id: number }) => product.id === productsId.value);
});

const currentCategory = computed(() => {
  if (!currentProductsDetail.value) return null;
  return productStore.categories.find((categories: { id: number }) =>
    categories.id === currentProductsDetail.value.categoryId
  );
});

const currentQuantity = computed(() => productStore.getProductQuantity(productsId.value));

const handleAddToCart = () => productStore.addToCart(productsId.value);
const handleIncrement = () => productStore.incrementQuantity(productsId.value);
const handleDecrement = () => productStore.decrementQuantity(productsId.value);

// Get main product image
const productImage = computed(() => {
  if (!currentProductsDetail.value?.image) return '';

  try {
    const imageArray = JSON.parse(currentProductsDetail.value.image);
    const imagePath = imageArray[0];
    const cleanPath = imagePath.replace(/\\/g, '/');
    return `http://localhost:3000/${cleanPath}`;
  } catch (error) {
    console.error('Error parsing image:', error);
    return '';
  }
});

// Helper function to get product image
const getProductImage = (product: any) => {
  try {
    const imageArray = JSON.parse(product.image);
    const imagePath = imageArray[0];
    const cleanPath = imagePath.replace(/\\/g, '/');
    return `http://localhost:3000/${cleanPath}`;
  } catch (err) {
    console.log(err);
    return '';
  }
};

const allProducts = computed(() => productStore.products);
const carouselIndex = ref(0);
const nextProduct = () => {
  if (carouselIndex.value < allProducts.value.length - 4) {
    carouselIndex.value++;
  }
};
const previousProduct = () => {
  if (carouselIndex.value > 0) {
    carouselIndex.value--;
  }
};


const navigateToProduct = (productId: number) => {
  router.push(`/products/${productId}`);
};

onMounted(() => {
  window.scrollTo({ top: 0 });
  if (productStore.products.length === 0 || productStore.categories.length === 0) {
    productStore.loadData();
  }


  const currentIndex = allProducts.value.findIndex((p: any) => p.id === productsId.value);
  if (currentIndex !== -1) {

    carouselIndex.value = Math.max(0, Math.min(currentIndex - 1, allProducts.value.length - 4));
  }
});
</script>

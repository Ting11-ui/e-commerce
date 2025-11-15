<template>
  <div>
    <button
      @click="shopNow(promotion)"
      :class="[
        btnColor[color] || btnColor.green,
        'text-white text-xl font-semibold w-44 h-12 rounded-md cursor-pointer shadow-sm transition-transform duration-200 hover:scale-105 flex items-center justify-center'
      ]"
    >
      <slot></slot>
      <i class="fa-solid fa-arrow-right ms-2"></i>
    </button>
  </div>
</template>

<script lang="ts">
export default {
  name: "button",

  props: {
    color: {
      type: String,
      default: "green",
    },
    promotion: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      btnColor: {
        green: "bg-green-400 hover:bg-green-500",
        yellow: "bg-yellow-300 hover:bg-yellow-400",
      },
    };
  },

  methods: {
    shopNow(promotion: { title: string; url?: string }) {
      alert("Let's shop: " + promotion.title);
      // Optional: navigate
      // if (promotion.url) window.location.href = promotion.url;
    },
  },
};
</script>

<style scoped>

</style>

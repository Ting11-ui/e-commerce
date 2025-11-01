<template>
  <div class="">
  <button @click="ShopNow()" :class="[btnColor[color] || btnColor.green, 'text-white text-xl font-semibold w-45 h-15 rounded-md cursor-pointer shadow-sm transition-transform duration-800 hover:scale-105 ']">
    <slot></slot>
    <i class="fa-solid fa-arrow-right ms-4"></i>
  </button>
  </div>
</template>

<script lang="ts">
import Promotion from './promotion.vue';

//import type { defineComponent } from 'vue';

export default {
  name: 'Btn',

  props: {
    color: {
      type: String,
      required: true,
      default: 'green',
    },
  },
  data() {
    return {
      btnColor: {
        green: 'bg-green-400 text-white hover:bg-green-500 ',
        yellow: 'bg-yellow-300 text-white hover:bg-yellow-400 ',
      },
      promotion: {      // Pass the promotion object from parent
      type: Object,
      required: true
    }

    }
  },
  methods: {
    ShopNow() {
      alert("Let's shop: " + this.promotion.title);
    },
  }
}

</script>

<style>

</style>

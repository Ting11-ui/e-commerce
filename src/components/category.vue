<template >
  <div class="w-30 h-35 rounded-xl flex flex-col justify-center items-center  ">
    <img :src='image' alt="" class="w-17 -mt-3">
      <div class=" justify-center items-center ">
        <h1 class="text-md font-semibold">{{ name }}</h1>
        <h1 class="text-grey-500 font-light text-center"><span>{{ qty }}</span> items</h1>
      </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'CategoryItem',
  props: {
    image: {
      type: String,
      required: true
    },
    name: {
      type: String,
      required: true
    },
    qty: {
      type: Number,
      required: true
    }
  }
})
</script>



<template>
  <div class="fadeIn">
    <!-- Navigation - Shows on ALL pages -->
    <nav class="flex justify-between items-center gap-12 fadeIn">
      <Header />
      <SearchBoxComponent/>
      <MenuIcons/>
    </nav>

    <router-link
     to="categories"></router-link>
    <MenuItems class="fadeIn"/>

    <!-- This is where pages will appear based on route -->
    <router-view />
  </div>
</template>

<script lang="ts" setup>
import Header from './components/header/HeaderLogo.vue'
import SearchBoxComponent from './components/searchBox/searchBoxComponent.vue'
import MenuIcons from './components/header/MenuIcons.vue'
import MenuItems from './components/header/MenuItems.vue'
</script>

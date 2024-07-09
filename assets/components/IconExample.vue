<template>
  <div class="flex items-center space-x-4">
    <HomeIcon class="h-5 w-5 text-blue-500"/>
    <UserIcon class="h-5 w-5 text-blue-500"/>
    <SearchIcon class="h-5 w-5 text-blue-500"/>
  </div>
</template>

<script>
import { HomeIcon, UserIcon, SearchIcon } from '@heroicons/vue/solid';

export default {
  components: {
    HomeIcon,
    UserIcon,
    SearchIcon
  }
}
</script>

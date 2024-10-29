<template>
    <div>{{ user }}</div>
</template>


<script setup>
const props = defineProps({
    user: Object
});

console.log(user);


</script>
<template>
  <div id="app" class="container">
    <h3>Welcome to my VUE JS App!</h3>
    <navbar/>
    <router-view/>
  </div>
</template>

<script>
    import navbar from '@/components/navbar/navbar.vue'

    export default {
        name: 'App',
        components: {
            navbar
        }
    };
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;

}
</style>


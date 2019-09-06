<style >
.fullscreen.content-wrapper, .fullscreen.main-footer, .fullscreen.main-header {
  margin-left:unset !important;
}
</style>

<template>
    <div>
      <notifications group="auth"/>
      <notifications group="notifications"/>
      <top-nav v-show="!$router.history.current.meta.hideTopNav"></top-nav>
      <side-bar v-show="!$router.history.current.meta.hideSidebar" ></side-bar>
      <!-- Content Wrapper. Contains page content -->
      <div :class="'content-wrapper ' + ($router.history.current.meta.fullScreent ? 'fullscreen': '')">
        <router-view></router-view>
      </div>
      <footer-section v-show="!$router.history.current.meta.hideFooter"></footer-section>
  </div>
</template>

<script>
import topNav from '@components/common/topnav.vue'
import sideBar from '@components/common/sidebar.vue'
import footerSection from '@components/common/footer.vue'
export default {
  components: {
    'top-nav': topNav,
    'side-bar': sideBar,
    'footer-section': footerSection
  },
  data(){
    return {
      route:null,
    }
  },
  mounted(){
  }
}
</script>
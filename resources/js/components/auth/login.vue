<style scoped>
.login-box 
{
    margin: 0 auto !important;
}

.login-logo
{
    width: 100% !important;
}
</style>
<template>
    <div>
        <div class="login-box">
        <div class="login-logo">
            <router-link tag="a" to="/"><b>Admin</b>LTE</router-link>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form @submit.prevent="login" method="post">
                <div class="input-group" name="username" >
                <input type="email" class="form-control" v-model="email" placeholder="Email/Username">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                    </div>
                </div>
                </div>
                <div class="input-group mt-3" name="password" >
                <input type="password" class="form-control" v-model="password" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                </div>
                <div class="row mt-3">
                <div class="col-8">
                    &nbsp;
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
                </div>
            </form>
            </div>
            <!-- /.login-card-body -->
        </div>
        </div>
      <loading :active.sync="loader.isLoading" 
        :can-cancel="loader.canCancel" 
        :is-full-page="loader.fullPage"></loading>
        
    </div>
</template>

<script>
import _ from 'lodash'
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
import helpers from '@helpers/methods.js'
export default {
  mixins: [helpers],
  name: 'homepage',
  data () {
    return {
      email: '',
      password: '',
      loader: {
        isLoading: false,
        fullPage: true,
        canCancel: false
      }
    }
  },

  components: {
    Loading
  },

  methods: {
    login: _.debounce(
        function(){
            $('.errors').empty();
            this.loader.isLoading = true;
            let username = this.email 
            let password = this.password
            this.$store.dispatch('login', { username, password })
            .then(resp => {
                this.loader.isLoading = false;
              this.$notify({
                  group: 'auth',
                  text: resp.data.message
              });
              this.$router.push('/');
            })
            .catch(error => {
              this.loader.isLoading = false;
              this.requestErrors(error);
            })
        }, 500 )
  }
}
</script>
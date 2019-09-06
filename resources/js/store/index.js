import Vue from 'vue'
import Vuex from 'vuex'
import storage from 'local-storage-fallback'

Vue.use(Vuex)

export const store = new Vuex.Store({

	state: {
		status: storage.getItem('token') ? 'login' : '',
		token: storage.getItem('token') || ''
	},

	mutations: {
		auth_request(state){
			state.status = 'loading'
		},
		auth_register(state){
			state.state = 'register'
		},
		auth_success(state, token, user){
			state.status = 'login'
			state.token = token
			state.user = user
		},
		auth_error(state){
			state.status = 'error'
		},
		logout(state){
			state.status = ''
			state.token = ''
		},
	},
	actions: {
		login({commit}, user){
			return new Promise((resolve, reject) => {
			  commit('auth_request')
			  axios.post('v1/login', user)
			  .then(resp => {
				let data = resp.data.data;
				const token = data.accessToken;
				const user = {
					name: data.first_name + " " + data.last_name,
					email: data.email,
					mobile: data.mobile,
					username: data.username 
				}
				localStorage.setItem('token', token)
				axios.defaults.headers.common['Authorization'] = 'Bearer '+ token
				commit('auth_success', token, user)
				resolve(resp)
			  })
			  .catch(err => {
				commit('auth_error')
				localStorage.removeItem('token')
				reject(err)
			  })
			})
		},
		register({commit}, user){
			return new Promise((resolve, reject) => {
			  commit('auth_request')
			  axios.post('v1/register', user)
			  .then(resp => {
				commit('auth_register')
				resolve(resp)
			  })
			  .catch(err => {
				commit('auth_error', err)
				reject(err)
			  })
			})
		  },
		  logout({commit}){
				return new Promise((resolve, reject) => {
					commit('auth_request')
					axios.post('v1/logout')
					.then(resp => {
						commit('logout')
						localStorage.removeItem('token')
						delete axios.defaults.headers.common['Authorization']
						resolve(resp)
					})	
					.catch(err => {
						commit('auth_error', err)
						reject(err)
					})				
				})
			},
			logoutWhen401({commit}){
				return new Promise((resolve, reject) => {
					commit('logout')
					localStorage.removeItem('token')
					delete axios.defaults.headers.common['Authorization']
					resolve()
				})
		  }
	},
	getters : {
		isLoggedIn: state => !!state.token,
		authStatus: state => state.status,
		token: state => state.token
	}
})

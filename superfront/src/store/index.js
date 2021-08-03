import { createStore } from 'vuex'
import showcase from './showcase'

export default function (/* { ssrContext } */) {
  const Store = createStore({
    modules: {
      showcase
    },

    // enable strict mode (adds overhead!)
    // for dev mode and --debug builds only
    strict: process.env.DEBUGGING
  })

  return Store
}

// import { store } from 'quasar/wrappers'
// import { createStore } from 'vuex'
// import {api} from 'boot/axios'
// // import axios from 'axios'
// // import example from './module-example'
//
// /*
//  * If not building with SSR mode, you can
//  * directly export the Store instantiation;
//  *
//  * The function below can be async too; either use
//  * async/await or return a Promise which resolves
//  * with the Store instance.
//  */
//
// export default store(function (/* { ssrContext } */) {
//   const Store = createStore({
//     // modules: {
//     //   // example
//     // },
//     state: {
//       status: '',
//       token: localStorage.getItem('token') || '',
//       user : {}
//     },
//     mutations: {
//       auth_request(state){
//         state.status = 'loading'
//       },
//       auth_success(state, data){
//         state.status = 'success'
//         state.token = data.token
//         state.user = data.user
//       },
//       auth_error(state){
//         state.status = 'error'
//       },
//       logout(state){
//         state.status = ''
//         state.token = ''
//       },
//     },
//     actions: {
//       login({commit}, user) {
//         return new Promise((resolve, reject) => {
//           commit('auth_request')
//           // axios({url: 'http://localhost:8000/api/login', data: user, method: 'POST' })
//           api.post(process.env.API+'/login', user)
//             .then(resp => {
//               // console.log(resp.data)
//               const token = resp.data.token
//               const user = resp.data.user
//               localStorage.setItem('token', token)
//               api.defaults.headers.common['Authorization'] = 'Bearer '+token
//               commit('auth_success', {token, user})
//               resolve(resp)
//             })
//             .catch(err => {
//               commit('auth_error')
//               localStorage.removeItem('token')
//               reject(err)
//             })
//         })
//       },
//       logout({commit}){
//         return new Promise((resolve, reject) => {
//           api.post(process.env.API+'/logout').then(res=>{
//             commit('logout')
//             localStorage.removeItem('token')
//             delete api.defaults.headers.common['Authorization']
//             resolve()
//           }).catch(err => {
//             commit('auth_error')
//             localStorage.removeItem('token')
//             reject(err)
//           })
//         })
//       }
//
//     },
//     getters : {
//       isLoggedIn: state => !!state.token,
//       authStatus: state => state.status,
//     },
//
//     // enable strict mode (adds overhead!)
//     // for dev mode and --debug builds only
//     strict: process.env.DEBUGGING
//   })
//
//   return Store
// })

/*
// export function someAction (context) {
// }
*/
import {axios} from '../../boot/axios'
export function login({commit}, user) {
        return new Promise((resolve, reject) => {
          commit('auth_request')
          // axios({url: 'http://localhost:8000/axios/login', data: user, method: 'POST' })
          axios.post('http://64.227.115.116:81/api'+'/login', user)
            .then(resp => {
              // console.log(resp.data)
              // resolve(resp)
              // return false
              const token = resp.data.token
              const user = resp.data.user
              localStorage.setItem('tokensu', token)
              axios.defaults.headers.common['Authorization'] = 'Bearer '+token
              commit('auth_success', {token, user})
              resolve(resp)
            })
            .catch(err => {
              commit('auth_error')
              localStorage.removeItem('tokensu')
              reject(err)
            })
        })
      }
export function mipedido({commit}, data) {
    commit('mipedido',data)
}

export function borrar({commit}, i) {
  commit('borrar',i)
}
export function limpiar({commit}, i) {
  commit('limpiar',i)
}

export function register({commit}, user) {
  return new Promise((resolve, reject) => {
    commit('auth_request')
    // axios({url: 'http://localhost:8000/axios/login', data: user, method: 'POST' })
    axios.post(process.env.API+'/register', user)
      .then(resp => {
        // console.log(resp.data)
        const token = resp.data.token
        const user = resp.data.user
        localStorage.setItem('tokensu', token)
        axios.defaults.headers.common['Authorization'] = 'Bearer '+token
        commit('auth_success', {token, user})
        resolve(resp)
      })
      .catch(err => {
        commit('auth_error')
        localStorage.removeItem('tokensu')
        reject(err)
      })
  })
}
export function logout({commit}){
  return new Promise((resolve, reject) => {
    axios.post(process.env.API+'/logout').then(res=>{
      commit('salir')
      localStorage.removeItem('tokensu')
      delete axios.defaults.headers.common['Authorization']
      resolve()
    }).catch(err => {
      commit('auth_error')
      localStorage.removeItem('tokensu')
      reject(err)
    })
  })
}

export function menu( agencia){

    localStorage.setItem('menuagencia', agencia)
}

// import {api} from "boot/axios"
// const api=require('../../boot/axios')
// module.exports= {
//         login({commit}, user) {
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
// }

/*
export function someMutation (state) {
}
*/
// module.exports = {
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
// }

export function auth_request(state){
        state.status = 'loading'
      }
export function auth_success(state, data){
        state.status = 'success'
        state.token = data.token
        state.user = data.user
      }
export function   auth_error(state){
        state.status = 'error'
      }
export function salir(state){
        state.status = ''
        state.token = ''
      }
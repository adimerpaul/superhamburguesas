
//export function someMutation (state) {
//}

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
  // console.log(data.user.tipo)
  if (data.user.tipo=='CLIENTE'){
    state.boolcliente=true;
  }
  if (data.user.tipo=='ADMIN'){
    state.booladmin=true;
  }
  if (data.user.tipo=='CAJERO'){
    state.boolcajero=true;
  }


}
export function mipedido(state, data){
  state.mipedido.push(data)
}
export function borrar(state, i){
  state.mipedido.splice(i, 1)
}
export function limpiar(state, i){
  state.mipedido=[]
}

export function   auth_error(state){
        state.status = 'error'
      }
export function salir(state){
  state.status = ''
  state.user = {}
  state.token = ''
  state.booladmin=false
  state.boolcliente=false
  state.boolcajero=false
}

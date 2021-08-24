/*
export function someGetter (state) {
}
*/
// module.exports= {
//   isLoggedIn: state => !!state.token,
//   authStatus: state => state.status,
// }
export function isLoggedIn (state) {
  return !!state.token
}

export function authStatus (state) {
  return state.status
}


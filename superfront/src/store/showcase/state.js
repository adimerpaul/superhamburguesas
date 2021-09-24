export default function () {
  return {
    status: '',
    token: localStorage.getItem('tokensu') || '',
    user : {},
    mipedido:[],
    menuagencia:{},
  }
}

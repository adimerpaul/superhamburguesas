export default function () {
  return {
    status: '',
    token: localStorage.getItem('tokensu') || '',
    user : {},
    pedido:[],
    menuagencia:{},
  }
}

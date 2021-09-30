export default function () {
  return {
    status: '',
    token: localStorage.getItem('tokensu') || '',
    user : {},
    mipedido:[],
    menuagencia:{},
    booladmin:false,
    boolcliente:false,
  }
}

<template>
  <q-page class="q-pa-md">
    <q-table title="Mis pedidos"></q-table>
  </q-page>
</template>

<script>
export default {
  data () {
    return {

    }
  },
  created() {
    this.mispedidos();
  },
  methods:{
    mispedidos(){
      this.$q.loading.show();
      this.$axios.get(process.env.API+'/pedido').then(res=>{
         console.log(res.data)
        // this.data=res.data;
        this.$q.loading.hide();
      })
    },
  }
}
</script>

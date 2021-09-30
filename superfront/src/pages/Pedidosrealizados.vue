<template>
  <q-page class="q-pa-md">
<!--    <q-table title="Mis pedidos"></q-table>-->
    <table style="width: 100%">
      <thead>
      <tr>
        <th>#</th>
        <th>Comanda</th>
        <th>Fecha </th>
        <th>Pedido</th>
        <th>Total</th>
        <th>Imprimir</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(p,i) in pedidos" :key="i">
        <td>{{i+1}}</td>
        <td>{{p.id}}</td>
        <th>{{p.fecha}} {{p.hora}}</th>
        <td>
          <b>Nombre</b> {{p.nombre}} <br>
          <b>Direccion</b> {{p.direccion}} <br>
          <b>Telefono</b> {{p.telefono}} <br>
          <ul>
            <li v-for="(d,i) in p.detalles" :key="i">
              {{d.cantidad}} {{d.nombre}} {{d.precio}} Bs
              <ul v-for="(s,i) in d.subdetalles" :key="i">
                <li>{{s.cantidad}} {{s.nombre}} </li>
              </ul>
            </li>
          </ul>
        </td>
        <th>{{p.total}} Bs</th>
        <td>
          <q-btn label="imprimir" icon="print"  color="teal" size="xs"/>
        </td>
      </tr>
      </tbody>
    </table>
  </q-page>
</template>

<script>
export default {
  data () {
    return {
      pedidos:[]
    }
  },
  created() {
    this.mispedidos();
  },
  methods:{
    mispedidos(){
      this.$q.loading.show();
      this.$axios.get(process.env.API+'/pedido').then(res=>{
         // console.log(res.data)
        // this.data=res.data;
        this.pedidos=res.data
        this.$q.loading.hide();
      })
    },
  }
}
</script>
<style>
table,tr,th,td{
  border: 0.2px solid gray;
  border-collapse: collapse;
}
</style>

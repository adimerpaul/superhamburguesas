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
        <th>Estado</th>
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
        <th>{{p.estado}}</th>
        <td>
          <q-btn label="imprimir" icon="print"  color="teal" size="xs" @click="imprimir(p.id)"/>
          <q-btn label="Ver" icon="list"  color="green" size="xs" @click="ver(p)"/>
        </td>
      </tr>
      </tbody>
    </table>
        <q-dialog v-model="alert">
      <q-card>
        <q-card-section>
          <div class="text-h6">Detalle</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <div v-for="row in detalle.detalles" :key="row">
            {{row.nombre}}
          </div>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="OK" color="primary" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script>
export default {
  data () {
    return {
      pedidos:[],
      alert:false,
      detalle:{}
    }
  },
  created() {
             if(!this.$store.state.showcase.booladmin && !this.$store.state.showcase.boolcajero)
      {location.href='/';
        return false;
      }
    this.mispedidos();
  },
  methods:{
    ver(pedido){
      this.alert=true;
      this.detalle=pedido;

    },
    imprimir(id){
      this.$axios.post(process.env.API+'/printpedido/'+id).then(res=>{
        let myWindow = window.open("", "Imprimir", "width=200,height=100");
        myWindow.document.write(res.data);
        myWindow.document.close();
        myWindow.focus();
        setTimeout(function(){
          myWindow.print();
          myWindow.close();
          // this.comanda(sale_id);
          //    impAniv(response);
        },500);
      })
    },
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

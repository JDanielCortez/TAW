    
    @extends ('principal')
    @section ('contenido')

    <template v-if="menu==0">
        <categorias-component></categorias-component>
    </template>

    <template v-if="menu==1">
        <articulos-component></articulos-component>
    </template>

    <template v-if="menu==2">
        <ingresos-component></ingresos-component>
    </template>

    
    @endsection
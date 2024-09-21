// angular import
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

// Project import
import { AdminComponent } from './theme/layouts/admin-layout/admin-layout.component';
import { GuestComponent } from './theme/layouts/guest/guest.component';

const routes: Routes = [
  {
    path: '',
    component: AdminComponent,
    children: [
      {
        path: '',
        redirectTo: '/dashboard/default',
        pathMatch: 'full'
      },
      {
        path: 'dashboard/default',
        loadComponent: () => import('./demo/default/dashboard/dashboard.component').then((c) => c.DefaultComponent)
      },
      {
        path: 'typography',
        loadComponent: () => import('./demo/ui-component/typography/typography.component')
      },
      {
        path: 'color',
        loadComponent: () => import('./demo/ui-component/ui-color/ui-color.component')
      },
      {
        path: 'sample-page',
        loadComponent: () => import('./demo/other/sample-page/sample-page.component')
      },
      {
        path: 'proveedores',
        loadComponent: () => import('./pages/proveedores/proveedores.component').then((m) => m.ProveedoresComponent)
      },
      {
        path: 'nuevoproveedor',
        loadComponent: () => import('./pages/proveedores/nuevo-proveedor/nuevo-proveedor.component').then((m) => m.NuevoProveedorComponent),
      },
      {
        path: 'editar-proveedor/:id',
        loadComponent: () => import('./pages/proveedores/nuevo-proveedor/nuevo-proveedor.component').then((m) => m.NuevoProveedorComponent),
      },
      {
        path: 'tipo-cliente',
        loadComponent: () => import('./pages/tipo-cliente/tipo-cliente.component').then((m) => m.TipoClienteComponent)
      },
      {
        path: 'nuevotipocliente',
        loadComponent: () => import('./pages/tipo-cliente/nuevo-tipo-cliente/nuevo-tipo-cliente.component').then((m) => m.NuevoTipoClienteComponent),
      },
      {
        path: 'editar-tipocliente/:id',
        loadComponent: () => import('./pages/tipo-cliente/nuevo-tipo-cliente/nuevo-tipo-cliente.component').then((m) => m.NuevoTipoClienteComponent),
      },
      {
        path: 'tipo-actividad',
        loadComponent: () => import('./pages/tipo-actividad/tipo-actividad.component').then((m) => m.TipoActividadComponent)
      },
      {
        path: 'nuevotipoactividad',
        loadComponent: () => import('./pages/tipo-actividad/nuevo-tipo-actividad/nuevo-tipo-actividad.component').then((m) => m.NuevoTipoActividadComponent),
      },
      {
        path: 'editar-tipoactividad/:id',
        loadComponent: () => import('./pages/tipo-actividad/nuevo-tipo-actividad/nuevo-tipo-actividad.component').then((m) => m.NuevoTipoActividadComponent),
      },
      {
        path: 'medio-contacto',
        loadComponent: () => import('./pages/medio-contacto/medio-contacto.component').then((m) => m.MedioContactoComponent)
      },
      {
        path: 'nuevomediocontacto',
        loadComponent: () => import('./pages/medio-contacto/nuevo-medio-contacto/nuevo-medio-contacto.component').then((m) => m.NuevoMedioContactoComponent),
      },
      {
        path: 'editar-mediocontacto/:id',
        loadComponent: () => import('./pages/medio-contacto/nuevo-medio-contacto/nuevo-medio-contacto.component').then((m) => m.NuevoMedioContactoComponent),
      },
      {
        path: 'actividades',
        loadComponent: () => import('./pages/actividades/actividades.component').then((m) => m.ActividadesComponent)
      },
      {
        path: 'nuevaactividad',
        loadComponent: () => import('./pages/actividades/nueva-actividad/nueva-actividad.component').then((m) => m.NuevaActividadComponent),
      },
      {
        path: 'editar-actividad/:id',
        loadComponent: () => import('./pages/actividades/nueva-actividad/nueva-actividad.component').then((m) => m.NuevaActividadComponent),
      },
      {
        path: 'actividades-proveedor',
        loadComponent: () => import('./pages/actividades-proveedor/actividades-proveedor.component').then((m) => m.ActividadesProveedorComponent)
      },
      {
        path: 'nuevaactividadproveedor',
        loadComponent: () => import('./pages/actividades-proveedor/nuevo-actividades-proveedor/nuevo-actividades-proveedor.component').then((m) => m.NuevoActividadesProveedorComponent),
      },
      {
        path: 'editar-actividadproveedor/:id',
        loadComponent: () => import('./pages/actividades-proveedor/nuevo-actividades-proveedor/nuevo-actividades-proveedor.component').then((m) => m.NuevoActividadesProveedorComponent),
      },
      {
        path: 'clientes',
        loadComponent: () => import('./pages/clientes/clientes.component').then((m) => m.ClientesComponent)
      },
      {
        path: 'nuevocliente',
        loadComponent: () => import('./pages/clientes/nuevo-cliente/nuevo-cliente.component').then((m) => m.NuevoClienteComponent),
      },
      {
        path: 'editar-cliente/:id',
        loadComponent: () => import('./pages/clientes/nuevo-cliente/nuevo-cliente.component').then((m) => m.NuevoClienteComponent),
      }
    ]
  },
  {
    path: '',
    component: GuestComponent,
    children: [
      {
        path: 'login',
        loadComponent: () => import('./demo/authentication/login/login.component')
      },
      {
        path: 'register',
        loadComponent: () => import('./demo/authentication/register/register.component')
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}

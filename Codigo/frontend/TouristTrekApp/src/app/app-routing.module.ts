// angular import
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

// Project import
import { AdminComponent } from './theme/layouts/admin-layout/admin-layout.component';
import { GuestComponent } from './theme/layouts/guest/guest.component';
import { usuariosGuardGuard } from './Guards/usuarios-guard.guard';

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
        loadComponent: () => import('./demo/default/dashboard/dashboard.component').then((c) => c.DefaultComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'typography',
        loadComponent: () => import('./demo/ui-component/typography/typography.component'),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'color',
        loadComponent: () => import('./demo/ui-component/ui-color/ui-color.component'),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'sample-page',
        loadComponent: () => import('./demo/other/sample-page/sample-page.component'),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'proveedores',
        loadComponent: () => import('./pages/proveedores/proveedores.component').then((m) => m.ProveedoresComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'nuevoproveedor',
        loadComponent: () => import('./pages/proveedores/nuevo-proveedor/nuevo-proveedor.component').then((m) => m.NuevoProveedorComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'editar-proveedor/:id',
        loadComponent: () => import('./pages/proveedores/nuevo-proveedor/nuevo-proveedor.component').then((m) => m.NuevoProveedorComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'tipo-cliente',
        loadComponent: () => import('./pages/tipo-cliente/tipo-cliente.component').then((m) => m.TipoClienteComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'nuevotipocliente',
        loadComponent: () => import('./pages/tipo-cliente/nuevo-tipo-cliente/nuevo-tipo-cliente.component').then((m) => m.NuevoTipoClienteComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'editar-tipocliente/:id',
        loadComponent: () => import('./pages/tipo-cliente/nuevo-tipo-cliente/nuevo-tipo-cliente.component').then((m) => m.NuevoTipoClienteComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'tipo-actividad',
        loadComponent: () => import('./pages/tipo-actividad/tipo-actividad.component').then((m) => m.TipoActividadComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'nuevotipoactividad',
        loadComponent: () => import('./pages/tipo-actividad/nuevo-tipo-actividad/nuevo-tipo-actividad.component').then((m) => m.NuevoTipoActividadComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'editar-tipoactividad/:id',
        loadComponent: () => import('./pages/tipo-actividad/nuevo-tipo-actividad/nuevo-tipo-actividad.component').then((m) => m.NuevoTipoActividadComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'medio-contacto',
        loadComponent: () => import('./pages/medio-contacto/medio-contacto.component').then((m) => m.MedioContactoComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'nuevomediocontacto',
        loadComponent: () => import('./pages/medio-contacto/nuevo-medio-contacto/nuevo-medio-contacto.component').then((m) => m.NuevoMedioContactoComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'editar-mediocontacto/:id',
        loadComponent: () => import('./pages/medio-contacto/nuevo-medio-contacto/nuevo-medio-contacto.component').then((m) => m.NuevoMedioContactoComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'actividades',
        loadComponent: () => import('./pages/actividades/actividades.component').then((m) => m.ActividadesComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'nuevaactividad',
        loadComponent: () => import('./pages/actividades/nueva-actividad/nueva-actividad.component').then((m) => m.NuevaActividadComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'editar-actividad/:id',
        loadComponent: () => import('./pages/actividades/nueva-actividad/nueva-actividad.component').then((m) => m.NuevaActividadComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'actividades-proveedor',
        loadComponent: () => import('./pages/actividades-proveedor/actividades-proveedor.component').then((m) => m.ActividadesProveedorComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'nuevaactividadproveedor',
        loadComponent: () => import('./pages/actividades-proveedor/nuevo-actividades-proveedor/nuevo-actividades-proveedor.component').then((m) => m.NuevoActividadesProveedorComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'editar-actividadproveedor/:id',
        loadComponent: () => import('./pages/actividades-proveedor/nuevo-actividades-proveedor/nuevo-actividades-proveedor.component').then((m) => m.NuevoActividadesProveedorComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'clientes',
        loadComponent: () => import('./pages/clientes/clientes.component').then((m) => m.ClientesComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'nuevocliente',
        loadComponent: () => import('./pages/clientes/nuevo-cliente/nuevo-cliente.component').then((m) => m.NuevoClienteComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'editar-cliente/:id',
        loadComponent: () => import('./pages/clientes/nuevo-cliente/nuevo-cliente.component').then((m) => m.NuevoClienteComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'porcentaje',
        loadComponent: () => import('./pages/porcentaje/porcentaje.component').then((m) => m.PorcentajeComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'nuevoporcentaje',
        loadComponent: () => import('./pages/porcentaje/nuevo-porcentaje/nuevo-porcentaje.component').then((m) => m.NuevoPorcentajeComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'editar-porcentaje/:id',
        loadComponent: () => import('./pages/porcentaje/nuevo-porcentaje/nuevo-porcentaje.component').then((m) => m.NuevoPorcentajeComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'roles',
        loadComponent: () => import('./pages/roles/roles.component').then((m) => m.RolesComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'nuevorol',
        loadComponent: () => import('./pages/roles/nuevo-rol/nuevo-rol.component').then((m) => m.NuevoRolComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'editar-rol/:id',
        loadComponent: () => import('./pages/roles/nuevo-rol/nuevo-rol.component').then((m) => m.NuevoRolComponent),
        canActivate: [usuariosGuardGuard]
      },
      {
        path: 'empleados',
        loadComponent: () => import('./pages/empleados/empleados.component').then((m) => m.EmpleadosComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'nuevoempleado',
        loadComponent: () => import('./pages/empleados/nuevo-empleado/nuevo-empleado.component').then((m) => m.NuevoEmpleadoComponent),
        // canActivate: [usuariosGuardGuard]
      },
      {
        path: 'editar-empleado/:id',
        loadComponent: () => import('./pages/empleados/nuevo-empleado/nuevo-empleado.component').then((m) => m.NuevoEmpleadoComponent),
        canActivate: [usuariosGuardGuard]
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

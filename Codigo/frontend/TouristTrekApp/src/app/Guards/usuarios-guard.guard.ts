import { inject, Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot } from '@angular/router';
import { map, Observable } from 'rxjs';
import { EmpleadosService } from '../services/empleados.service';

@Injectable({
  providedIn: 'root'
})
export class usuariosGuardGuard implements CanActivate {

private empleadoService = inject(EmpleadosService);
private navegacion = inject(Router);

  constructor( ) {}

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<boolean> | boolean {
    return this.empleadoService.isLoggedIn().pipe(
      map((loggedIn) => {
        console.log(loggedIn);
        if (!loggedIn) {
          this.navegacion.navigate(['/login']);
          return false;
        }
        return true;
      })
    );
  }
}

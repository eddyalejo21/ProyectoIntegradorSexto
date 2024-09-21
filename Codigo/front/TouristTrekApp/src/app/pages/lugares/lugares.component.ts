import { Component, inject } from '@angular/core';
import { RouterLink } from '@angular/router';
import { ILugar } from 'src/app/interfaces/lugares';
import { LugaresService } from 'src/app/services/lugares.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';

@Component({
  selector: 'app-lugares',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './lugares.component.html',
  styleUrl: './lugares.component.scss'
})
export class LugaresComponent {
 
  private lugaresService = inject(LugaresService);

  title = 'Lista de Comercios';
  listaLugares: ILugar[] = [];

  constructor() { }

  ngOnInit(): void {
    this.cargarTabla();
  }
  
  cargarTabla() {
    this.lugaresService.todos().subscribe((data) => {
      this.listaLugares = data;
    });
  }

  eliminar(id_lugar: number) {
    this.lugaresService.eliminar(id_lugar).subscribe((data) => {
      this.cargarTabla();
    });
  }
}

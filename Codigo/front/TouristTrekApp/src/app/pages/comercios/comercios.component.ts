import { HttpClientModule } from '@angular/common/http';
import { Component, inject, OnInit } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { RouterLink } from '@angular/router';
import { IComercio } from 'src/app/interfaces/comercios';
import { ComerciosService } from 'src/app/services/comercios.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';

@Component({
  selector: 'app-comercios',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './comercios.component.html',
  styleUrl: './comercios.component.scss'
})
export class ComerciosComponent implements OnInit {

  private comerciosService = inject(ComerciosService);

  title = 'Lista de Comercios';
  listaComercios: IComercio[] = [];

  constructor() { }

  ngOnInit(): void {
    this.cargarTabla();
  }
  
  cargarTabla() {
    this.comerciosService.todos().subscribe((data) => {
      this.listaComercios = data;
    });
  }

  eliminar(id_comercio: number) {
    this.comerciosService.eliminar(id_comercio).subscribe((data) => {
      this.cargarTabla();
    });
  }
}

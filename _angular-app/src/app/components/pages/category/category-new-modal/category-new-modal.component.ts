import {Component, EventEmitter, OnInit, Output, ViewChild} from '@angular/core';
import {ModalComponent} from "../../../bootstrap/modal/modal.component";
import {HttpErrorResponse} from "@angular/common/http";
import {CategoryHttpService} from "../../../../services/http/category-http.service";
import {Category} from "../../../../model";

@Component({
  selector: 'category-new-modal',
  templateUrl: './category-new-modal.component.html',
  styleUrls: ['./category-new-modal.component.css']
})
export class CategoryNewModalComponent implements OnInit {

    category: Category = {
        name: '',
        active: true
    };

    @ViewChild(ModalComponent) modal: ModalComponent;

    @Output() onSuccess: EventEmitter<any> = new EventEmitter<any>();
    @Output() onError: EventEmitter<HttpErrorResponse> = new EventEmitter<HttpErrorResponse>();

    constructor(public categoryHtpt: CategoryHttpService) { }

    ngOnInit() {
    }

    submit() {
        this.categoryHtpt
            .create(this.category)
            .subscribe((category) => {
                this.onSuccess.emit(category);
                this.modal.hide();
                //this.getCategories();
            }, error => this.onError.emit(error));
    }

    showModal(){
        this.modal.show();
    }

    hideModal($event){
        console.log($event)
    }

}

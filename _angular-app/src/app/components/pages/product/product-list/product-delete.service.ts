import {Injectable} from "@angular/core";
import {HttpErrorResponse} from "@angular/common/http";
import {NotifyMessageService} from "../../../../services/notify-message.service";
import {ProductListComponent} from "./product-list.component";

@Injectable({
    providedIn: 'root'
})

export class ProductDeleteService {

    private  _productListComponent: ProductListComponent;

    constructor(private notifyMessage: NotifyMessageService){

    }

    set productListComponent(value: ProductListComponent){
        this._productListComponent = value;
    }

    showModalDelete(productId: number) {
        this._productListComponent.productId = productId;
        this._productListComponent.productDeleteModal.showModal();
    }

    onDeleteSuccess($event: any) {
        this.notifyMessage.success('Produto excluído com sucesso.');
        console.log($event)
        this._productListComponent.getProducts();
    }

    onDeleteError($event: HttpErrorResponse) {
        console.log($event);
        this.notifyMessage.error(`Não foi possível excluir o produto.`)
    }
}
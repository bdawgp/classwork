class PagesController < ApplicationController
  before_action :set_page, only: [:edit, :update, :destroy]
  before_action :authenticate_user!, except: [:index, :show]

  respond_to :html

  def index
    @pages = Page.all.sort_by(&:trending_score).reverse
    respond_with(@pages)
  end

  def show
    @page = Page.friendly.find(params[:id])
    @posts = @page.posts.order('updated_at desc')
    respond_with(@page)
  end

  def new
    @page = Page.new
    respond_with(@page)
  end

  def edit
  end

  def create
    @page = Page.new(page_params)
    @page.user = current_user
    @page.save
    respond_with(@page)
  end

  def update
    @page.update(page_params)
    respond_with(@page)
  end

  def destroy
    @page.destroy
    respond_with(@page)
  end

  private
    def set_page
      @page = current_user.pages.friendly.find(params[:id])
    end

    def page_params
      params.require(:page).permit(:title, :intro, :category)
    end
end

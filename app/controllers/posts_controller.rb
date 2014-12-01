class PostsController < ApplicationController
  before_action :set_post, only: [:edit, :update, :destroy]

  respond_to :html

  def index
    @posts = Post.order('updated_at desc').all
    respond_with(@posts)
  end

  def show
    @post = Post.find(params[:id])
    respond_with(@post)
  end

  def new
    @post = Post.new(page_id: params[:page_id])
    respond_with(@post)
  end

  def edit
  end

  def create
    @post = Post.new(post_params)
    @post.user = current_user
    @post.save

    if params[:post][:return_to_page]
      redirect_to page_path @post.page_id, created: @post.id
    else
      respond_with(@post)
    end
  end

  def update
    @post.update(post_params)
    respond_with(@post)
  end

  def destroy
    @post.destroy

    if params[:return_to_page]
      redirect_to page_path @post.page_id, destroyed: @post.id
    else
      respond_with(@post)
    end

  end

  private
    def set_post
      @post = (current_user || User.new).posts.find(params[:id])
    end

    def post_params
      params.require(:post).permit(:content, :picture, :user_id, :page_id)
    end
end

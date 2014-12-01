class CreatePages < ActiveRecord::Migration
  def change
    create_table :pages do |t|
      t.string :title
      t.string :slug
      t.string :intro
      t.string :category

      t.timestamps
    end
  end
end

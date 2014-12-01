# == Schema Information
#
# Table name: posts
#
#  id         :integer          not null, primary key
#  content    :text
#  user_id    :integer
#  page_id    :integer
#  created_at :datetime
#  updated_at :datetime
#  picture    :string(255)
#
# Indexes
#
#  index_posts_on_page_id  (page_id)
#  index_posts_on_user_id  (user_id)
#

class Post < ActiveRecord::Base
  belongs_to :user
  belongs_to :page

  mount_uploader :picture, PostPictureUploader

  validates :content, presence: true, length: { maximum: 160 }
  validates :user_id, :page_id, presence: true
end

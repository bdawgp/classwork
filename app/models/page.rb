# == Schema Information
#
# Table name: pages
#
#  id         :integer          not null, primary key
#  title      :string(255)
#  slug       :string(255)
#  intro      :string(255)
#  category   :string(255)
#  created_at :datetime
#  updated_at :datetime
#  user_id    :integer
#
# Indexes
#
#  index_pages_on_user_id  (user_id)
#

class Page < ActiveRecord::Base
  has_many :posts, dependent: :destroy
  belongs_to :user

  validates :title, presence: true, length: { minimum: 10 }
  validates :intro, :category, presence: true

  extend FriendlyId
  friendly_id :title, use: :slugged

  def trending_score
    last_post = posts.last
    top = posts.count * 100
    bottom = (Time.now - (last_post || self).created_at)
    top/bottom
  end
end
